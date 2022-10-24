calcFactor(5);

function calcFactor(num){
    let res=num;
    for (let i = 1; i < num; i++) {
        res=res*i;
    }
    console.log(res);
}