addEventListener("DOMContentLoaded", () => {
    let anims = document.querySelectorAll("[data-anim]");

    for (let i = 0; i < anims.length; i++) {
        anims[i].classList.add(anims[i].getAttribute("data-anim"));
    }

    animate(anims);

    addEventListener("scroll", () => {
        animate(anims);
    })
})

function animate(anims) {
    for (let i = 0; i < anims.length; i++) {
        if (inView(anims[i])) {
            setTimeout(() => {
                anims[i].classList.add("animate");
            }, Number(anims[i].getAttribute("data-delay")));
        }
    }
}

function inView(elem) {
    let y = elem.getBoundingClientRect().y;
    let height = elem.getBoundingClientRect().height;

    if (y + height * .75 > 0 && y < innerHeight * 0.75) {
        return true;
    }
    return false;
}