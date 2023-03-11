let total = 0;
const movimentsBancaris = [[
    {
        "date":"2022/10/22",
        "resume":"Metasports Padel",
        "type":"Altres",
        "import": 15.10,
        "balance": 5896.31,
        "Details": "Metasports Padel. Subscripcio mensual\n Titular Pepito de los palotes."
    },
    {
        "date":"2022/10/20",
        "resume":"Mercadona SA",
        "type":"Alimentació",
        "import": 87.34,
        "balance": 5983.65,
        "Details": "Mercadona SA. Tarjeta de crèdit ...8118"
    },
    {
        "date":"2022/10/18",
        "resume":"Orange SA",
        "type":"Casa",
        "import": 42.51,
        "balance": 6026.16,
        "Details": "Factura Nº 20221532156872\n Titular Pepito de los palotes\n"
    },
    {
        "date":"2022/10/15",
        "resume":"Tallers Pepito SL",
        "type":"Altres",
        "import": -387.68,
        "balance": 6413.84,
        "Details": "Tallers Pepito SL. Tarjeta de crèdit ...8118"
    },
    {
        "date":"2022/10/12",
        "resume":"Tan bo com a casa",
        "type":"Oci",
        "import": -36.12,
        "balance": 6449.96,
        "Details": "Restaurant Tan bó com a casa. Tarjeta de crèdit ...8118"
    },
    {
        "date":"2022/10/08",
        "resume":"Hipoteca 2%",
        "type":"Credit",
        "import": -487.15,
        "balance": 6937.11,
        "Details": ""
    },
    {
        "date":"2022/10/05",
        "resume":"Iberdrola S.A",
        "type":"Casa",
        "import": -46.35,
        "balance": 6983.46,
        "Details": "Factura Nº 20221532156872\n Titular Pepito de los palotes\n CUPS 08654 2103 56404"
    }    
],


[
    {
        "date":"2022/10/1",
        "resume":"Nomina Setembre",
        "type":"Altres",
        "import": 1587.10,
        "balance": 5396.36,
        "Details": "Metasports Padel. Subscripcio mensual\n Titular Pepito de los palotes."
    },
    {
        "date":"2022/09/20",
        "resume":"Mercadona SA",
        "type":"Alimentació",
        "import": 76.89,
        "balance": 5808.97,
        "Details": "Mercadona SA. Tarjeta de crèdit ...8118"
    },
    {
        "date":"2022/09/18",
        "resume":"Orange SA",
        "type":"Casa",
        "import": 42.51,
        "balance": 5766.46,
        "Details": "Factura Nº 20221532156872\n Titular Pepito de los palotes\n"
    },
    {
        "date":"2022/09/08",
        "resume":"Hipoteca 2%",
        "type":"Credit",
        "import": -487.15,
        "balance": 6937.11,
        "Details": "Hipoteca 2%\n titular: Pepito de los palotes\n ref catrastral: 90243871 12834 128347 12849"
    }

]];

$(document).ready(function(){

    $('#ex1Resultat').html("");
    $('.premium').css('background-color','#9196f3');
    $('.seat').click(function () {

        const normal = 5;
        const premium = 8;
        const jqEl = $(this);

        if (!this.classList.contains('occupied')) {
            if (!this.classList.contains('reserved')){
                jqEl.addClass('reserved');

                if (this.classList.contains('premium')) {
                    total+=premium;
                } else {
                    total+=normal;
                }

            } else {
                jqEl.removeClass('reserved');

                if (this.classList.contains('premium')) {
                    total-=premium;
                } else {
                    total-=normal;
                }
            }
        }

        $('#ex1Resultat').html('<div>TOTAL: '+total+'€</div>');;

        //console.log(total);
        
    });


    $('.seat').hover(function () {
            const jqEl = $(this);
            const seat = $(this).data('seat');
            const row = jqEl.parent().data('row');
            jqEl.html('<div>'+row+'-'+seat+'</div>');
        }, function () {
            const jqEl = $(this);
            jqEl.html('');
        }
    );
    $('#resultatEx2').html('');
    $('#resultatEx2').movimentsCC(movimentsBancaris[0]);

});


jQuery.fn.movimentsCC = function(jsonData) {
    console.log(jsonData);
    const jqEl = $(this);

    jqEl.css({
        'display': 'grid',
        'grid-template-columns': 'repeat(5,1fr)'
    });

    ['Date','Resume','Type','Input','Balance'].forEach(colName => {
        jqEl.append($('<div>').css({
            padding: '5px',
            border: '1px solid black',
            'background-color': '#fef',
            'font-weight': 'bold'
        }).text(colName));
    })

    $.each(jsonData, function (i,row) { 
        //console.log(val);
        $.each(row, function (colName,info) {
            
            if (colName != 'Details') {
                jqEl.append($('<div data-pos='+i+' class="info">').css({
                    padding: '5px',
                    border: '1px solid black',
                }).text(info));
            }
            
        });

        // console.log(val.balance);
        // console.log(val.date);
        // console.log(val.import);
        // console.log(val.resume);
        // console.log(val.type);
    });

    const table = jqEl.html();

    jqEl.html(table+'<div id="extra-data"></div>');

};


