const typewriter = (param) => {
    let el = document.querySelector(param.el);
    let speed = param.speed;
    let string = param.string.split("");

    string.forEach((char, index) => {
        setTimeout(() => {
            el.textContent += char;
        }, speed * index);
    });
};

typewriter({
    el: "#typewriter",
    speed: 200,
    string: "Login Page"
});
// Lorem ipsum dolor sit amet, consectetur adipiscing elit