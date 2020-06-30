var canvas = document.getElementById('canv');
canvas.height = window.innerHeight;
canvas.width = window.innerWidth;
var ctx = canvas.getContext('2d');
window.addEventListener('resize', changeCanvas);
function changeCanvas(){
    canvas.height = window.innerHeight;
    canvas.width = window.innerWidth;
}
var questionmark = {
    x : 100,
    y : 200,
    radius: 10,
    xv: 1,
    yv: 1,
    draw: function(){
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, Math.PI, -3*Math.PI/2);
        ctx.moveTo(this.x, this.y+this.radius);
        ctx.lineTo(this.x, this.y+25);
        ctx.stroke();
    }
};
var clones = [];
for(let x = 0; x < 20; x++){
    var clone = Object.assign({}, questionmark);
    clone.x = Math.floor(Math.random() * window.innerWidth+1);
    clone.y = Math.floor(Math.random() * window.innerHeight+1);
    clone.xv = Math.floor(Math.random()*2) == 1 ? 1 : -1;
    clone.yv = Math.floor(Math.random()*2) == 1 ? 1 : -1;
    clones.push(clone);
}
function activate(){
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    clones.map(x => x.draw());
    clones.map(x => { if (x.x >= window.innerWidth || x.x <= 0) {x.xv *= -1;}});
    clones.map(x => { if (x.y >= window.innerHeight || x.y <= 0) {x.yv *= -1;}});
    clones.map(x => x.x += x.xv);
    clones.map(x => x.y += x.yv);
    window.requestAnimationFrame(activate);
}
activate();