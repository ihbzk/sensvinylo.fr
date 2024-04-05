<script>
    document.addEventListener("DOMContentLoaded", () => {
        let notification_toggle = document.getElementsByClassName("notification_toggle");
        let notifications = document.getElementsByClassName("notification");
        for (let i = 0; i < notification_toggle.length; i++) {
            notification_toggle[i].addEventListener("click", () => {
                notifications[i].classList.add("hide");
                let index = i;
                setTimeout(() => {
                    notifications[index].remove()
                }, 1000);
            })
        }
    })
</script>

<script>
    let dropdowns = document.getElementsByClassName("navbar-dropdown");

    for (let i = 0; i < dropdowns.length; i++) {
        let title = dropdowns[i].querySelector(".dropdown-title");
        let body = dropdowns[i].querySelector(".dropdown-body");

        title.addEventListener("click", () => {
            dropdowns[i].classList.toggle("active");
        })

        body.addEventListener("mouseleave", () => {
            dropdowns[i].classList.remove("active");
        })

    }
</script>