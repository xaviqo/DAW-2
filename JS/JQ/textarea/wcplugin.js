jQuery.fn.wordCounter = function() {
    this.each(function(index,element){
        const ele = $(element);
        ele.after('<div class="counter">Contador: 0</div>');
        ele.keyup(function(e){
            const element = $(e.currentTarget);
            const counter = element.val().length;
            element.next().html('contador: '+counter);
        });
    });
}