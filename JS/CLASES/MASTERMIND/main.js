window.onload = () => {

    const SEQ_HTML = document.querySelector('.sequence');
    const NUM_HTML = document.querySelector('.allNumbers');
    const RES_HTML = document.querySelector('.result');
    const ALL_SEQ_HTML_DIV = document.querySelector('.allSequences');
    const ALL_RES_HTML_DIV = document.querySelector('.allResults');

    SEQ_HTML.remove();
    RES_HTML.remove();

    for (let i = 10; i > 0; i--) {
        NUM_HTML.innerHTML+=`<div>${i}</div>`;

        SEQ_HTML.setAttribute('id',`seq_${i}`);
        ALL_SEQ_HTML_DIV.appendChild(SEQ_HTML.cloneNode(true));

        RES_HTML.setAttribute('id',`res_${i}`);
        ALL_RES_HTML_DIV.appendChild(RES_HTML.cloneNode(true));
    }

    console.log(ALL_SEQ_HTML_DIV);
    
}