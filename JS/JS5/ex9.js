uplow = (text) => {
    let hasUp = false;
    let hasLw = false;

    for (i = 0; i < text.length; i++) {
        if (text.charAt(i) == text.charAt(i).toUpperCase()) hasUp = true;
        if (text.charAt(i) == text.charAt(i).toLowerCase()) hasLw = true;
    }
    
    if (hasUp && hasLw){
        console.log(`Text ${text} has upper and lowercase letters`);
    } else if (hasUp) {
        console.log(`Text ${text} is completely in capital letters`);
    } else {
        console.log(`Text ${text} is completely in lowercase`);
    }
}

const text = "lorem ipsum";

uplow(text);

