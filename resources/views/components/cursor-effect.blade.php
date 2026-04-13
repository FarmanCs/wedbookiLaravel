{{-- Cursor smoke effect - reusable across all layouts --}}
<canvas id="vd-fx-canvas" aria-hidden="true"></canvas>

<style>
    #vd-fx-canvas {
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 900;
        width: 100vw;
        height: 100vh;
        background: transparent;
    }
</style>

<script>
    (function() {
        'use strict';

        const canvas = document.getElementById('vd-fx-canvas');
        const ctx = canvas.getContext('2d');

        function resize() {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', () => {
            resize();
            rebuildOrbs();
        });

        const SMOKE_PALETTES = [
            ['#c084fc', '#a855f7', '#e879f9'],
            ['#38bdf8', '#22d3ee', '#67e8f9'],
            ['#f472b6', '#fb7185', '#fda4af'],
            ['#34d399', '#6ee7b7', '#5eead4'],
            ['#fbbf24', '#fb923c', '#fde68a'],
            ['#818cf8', '#6366f1', '#a78bfa']
        ];
        const STAR_COLORS = ['#c084fc', '#a78bfa', '#818cf8', '#6366f1', '#38bdf8', '#67e8f9', '#5eead4', '#2dd4bf',
            '#f472b6', '#fda4af', '#fbbf24', '#fde68a', '#ffffff', '#e0e7ff', '#ddd6fe', '#bfdbfe'
        ];
        const ORB_COLORS = ['#a855f7', '#818cf8', '#38bdf8', '#34d399', '#f472b6', '#fbbf24', '#e879f9'];

        let palIdx = 0,
            palTimer = 0;

        const rgba = (hex, a) => {
            const r = parseInt(hex.slice(1, 3), 16),
                g = parseInt(hex.slice(3, 5), 16),
                b = parseInt(hex.slice(5, 7), 16);
            return `rgba(${r},${g},${b},${Math.max(0, +a.toFixed(3))})`;
        };
        const rand = (a, b) => a + Math.random() * (b - a);

        const mouse = {
                x: -999,
                y: -999
            },
            vel = {
                x: 0,
                y: 0
            };
        let lx = 0,
            ly = 0,
            moving = false,
            moveTimer = null;
        const IDLE_MS = 140;
        const smoke = [],
            flecks = [],
            stars = [],
            orbs = [];

        class SmokePuff {
            constructor(x, y, vx, vy, pal) {
                this.x = x + rand(-9, 9);
                this.y = y + rand(-9, 9);
                this.vx = vx * .15 + rand(-1.1, 1.1);
                this.vy = vy * .15 + rand(-1.3, .6) - .4;
                this.c = pal[Math.floor(Math.random() * pal.length)];
                this.r = rand(10, 26);
                this.grow = rand(1.010, 1.025);
                this.life = 1.0;
                this.decay = rand(.014, .024);
            }
            step() {
                this.x += this.vx;
                this.vx *= .968;
                this.y += this.vy;
                this.vy *= .968;
                this.vy -= .016;
                this.r *= this.grow;
                this.life -= this.decay;
            }
            draw() {
                if (this.life <= 0) return;
                const a = this.life * .14,
                    g = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.r);
                g.addColorStop(0, rgba(this.c, a));
                g.addColorStop(.5, rgba(this.c, a * .4));
                g.addColorStop(1, rgba(this.c, 0));
                ctx.save();
                ctx.globalCompositeOperation = 'source-over';
                ctx.fillStyle = g;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                ctx.fill();
                ctx.restore();
            }
            get dead() {
                return this.life <= 0 || this.r < .5;
            }
        }

        class Star {
            constructor(boot) {
                this.boot = boot;
                this.reset();
            }
            reset() {
                this.x = rand(10, canvas.width - 10);
                this.y = rand(10, canvas.height - 10);
                this.c = STAR_COLORS[Math.floor(Math.random() * STAR_COLORS.length)];
                this.maxA = rand(.28, .55);
                this.dot = rand(.7, 2);
                this.cross = Math.random() < .28;
                this.arm = this.dot * rand(3, 6.5);
                this.phase = this.boot ? Math.floor(Math.random() * 3) : 0;
                this.a = (this.boot && this.phase > 0) ? this.maxA * rand(.3, 1) : 0;
                this.fi = rand(.006, .015);
                this.fo = rand(.005, .012);
                this.holdN = Math.floor(rand(60, 200));
                this.held = this.boot ? Math.floor(Math.random() * this.holdN) : 0;
                this.dx = rand(-.07, .07);
                this.dy = rand(-.06, .06);
                this.boot = false;
            }
            step() {
                this.x += this.dx;
                this.y += this.dy;
                if (this.phase === 0) {
                    this.a += this.fi;
                    if (this.a >= this.maxA) {
                        this.a = this.maxA;
                        this.phase = 1;
                    }
                } else if (this.phase === 1) {
                    if (++this.held >= this.holdN) this.phase = 2;
                } else {
                    this.a -= this.fo;
                    if (this.a <= 0) this.reset();
                }
            }
            draw(s) {
                const a = this.a * s;
                if (a < .01) return;
                ctx.save();
                ctx.globalAlpha = a;
                ctx.globalCompositeOperation = 'source-over';
                ctx.fillStyle = this.c;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.dot, 0, Math.PI * 2);
                ctx.fill();
                if (this.cross) {
                    const L = this.arm;
                    ctx.strokeStyle = this.c;
                    ctx.lineWidth = .65;
                    ctx.globalAlpha = a * .7;
                    ctx.beginPath();
                    ctx.moveTo(this.x - L, this.y);
                    ctx.lineTo(this.x + L, this.y);
                    ctx.moveTo(this.x, this.y - L);
                    ctx.lineTo(this.x, this.y + L);
                    ctx.stroke();
                }
                ctx.restore();
            }
        }

        class FloatOrb {
            constructor() {
                this.init();
            }
            init() {
                this.x = rand(0, canvas.width);
                this.y = rand(0, canvas.height);
                this.r = rand(50, 110);
                this.c = ORB_COLORS[Math.floor(Math.random() * ORB_COLORS.length)];
                this.vx = rand(-.16, .16);
                this.vy = rand(-.12, .12);
                this.a = 0;
                this.tA = rand(.04, .08);
                this.spd = rand(.006, .012);
                this.phase = 0;
                this.life = Math.floor(rand(350, 750));
                this.lived = 0;
            }
            step() {
                if (this.phase === 0) {
                    this.a += this.spd;
                    if (this.a >= this.tA) {
                        this.a = this.tA;
                        this.phase = 1;
                    }
                } else if (this.phase === 1) {
                    this.x += this.vx;
                    this.y += this.vy;
                    if (++this.lived >= this.life) this.phase = 2;
                } else {
                    this.a -= this.spd * .6;
                    if (this.a <= 0) this.init();
                }
            }
            draw(s) {
                const a = this.a * s;
                if (a < .003) return;
                const g = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.r);
                g.addColorStop(0, rgba(this.c, a));
                g.addColorStop(.55, rgba(this.c, a * .3));
                g.addColorStop(1, rgba(this.c, 0));
                ctx.save();
                ctx.globalCompositeOperation = 'source-over';
                ctx.fillStyle = g;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                ctx.fill();
                ctx.restore();
            }
        }

        class Fleck {
            constructor(x, y, c) {
                this.x = x;
                this.y = y;
                this.vx = rand(-3.5, 3.5);
                this.vy = rand(-3.5, 3.5) - 1.2;
                this.c = c;
                this.r = rand(1.2, 2.8);
                this.a = 1;
                this.d = rand(.04, .07);
            }
            step() {
                this.x += this.vx;
                this.vx *= .96;
                this.y += this.vy;
                this.vy += .09;
                this.a -= this.d;
                this.r *= .97;
            }
            draw() {
                if (this.a <= 0 || this.r < .2) return;
                ctx.save();
                ctx.globalAlpha = Math.max(0, this.a * .7);
                ctx.globalCompositeOperation = 'source-over';
                ctx.fillStyle = this.c;
                ctx.shadowColor = this.c;
                ctx.shadowBlur = 6;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                ctx.fill();
                ctx.restore();
            }
            get dead() {
                return this.a <= 0 || this.r < .2;
            }
        }

        for (let i = 0; i < 70; i++) stars.push(new Star(true));

        function rebuildOrbs() {
            orbs.length = 0;
            for (let i = 0; i < 7; i++) orbs.push(new FloatOrb());
        }
        rebuildOrbs();

        function spawnSmoke() {
            const pal = SMOKE_PALETTES[palIdx % SMOKE_PALETTES.length];
            const speed = Math.sqrt(vel.x ** 2 + vel.y ** 2);
            const n = Math.min(Math.floor(speed * .28) + 1, 5);
            for (let i = 0; i < n; i++) smoke.push(new SmokePuff(mouse.x, mouse.y, vel.x, vel.y, pal));
            if (speed > 7 && Math.random() < .45) {
                const c = pal[Math.floor(Math.random() * pal.length)];
                for (let i = 0, k = 1 + Math.floor(Math.random() * 3); i < k; i++) flecks.push(new Fleck(mouse.x,
                    mouse.y, c));
            }
        }

        let idleScale = 1;

        function loop() {
            requestAnimationFrame(loop);
            palTimer++;
            if (palTimer > 55) {
                palIdx++;
                palTimer = 0;
            }
            const target = moving ? 0 : 1;
            idleScale += (target - idleScale) * .05;
            if (moving) spawnSmoke();
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (const o of orbs) {
                o.step();
                o.draw(idleScale);
            }
            for (const s of stars) {
                s.step();
                s.draw(idleScale);
            }
            for (let i = smoke.length - 1; i >= 0; i--) {
                smoke[i].step();
                smoke[i].draw();
                if (smoke[i].dead) smoke.splice(i, 1);
            }
            for (let i = flecks.length - 1; i >= 0; i--) {
                flecks[i].step();
                flecks[i].draw();
                if (flecks[i].dead) flecks.splice(i, 1);
            }
        }
        loop();

        document.addEventListener('mousemove', e => {
            vel.x = (e.clientX - lx) * 1;
            vel.y = (e.clientY - ly) * 1;
            lx = mouse.x = e.clientX;
            ly = mouse.y = e.clientY;
            moving = true;
            clearTimeout(moveTimer);
            moveTimer = setTimeout(() => {
                moving = false;
            }, IDLE_MS);
        });
    })();
</script>
