jQuery.fn.counter = function () {
    //this serán todos los textarea, en html $('textarea).counter();
    this.each(function (index, element) {
         let ele = $(element);
         ele.after('<div class="counter">Contador: 0</div>');
         
         ele.keyUp(function (e) {
        let element = $(e.currentTarget);
        let count = element.val().length;
            //coge el siguiente div
        element.next().html('contador: ' + count);
        })
    })
}