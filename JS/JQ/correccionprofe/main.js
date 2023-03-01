jQuery.fn.charCounter = function () {
  this.each(function (index, element) {
    $(element).after(`<div class="result">Number: 0</div>`);
    $(element).keyup(function (e) {
      let element = $(e.currentTarget);
      let value = element.val();
      element.next().html(`Number: ${value.length}`);
    });
  });
};
