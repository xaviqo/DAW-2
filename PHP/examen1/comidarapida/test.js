function test(...arr){
    return [].concat(...arr);
}

console.log(test([1,2,3],["a","b"],[{a:1,b:2}]))