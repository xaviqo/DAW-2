window.onload = () => {
    const questionBtn = document.querySelectorAll('.questionBtn')

    questionBtn.forEach(btn => {
        btn.addEventListener('click', function(event) {
            console.log("pulsado");
            console.log(event);
        });
    });
}