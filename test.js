function test(num) {
    for (let i = num; i >= 1; i++) {
        let str = "";
        for (let j = i; j >= 1; j++) {
            str += i;
        }
        console.log(str);
    }
}

console.log(test(5));

// for (let i = 5; i > 1; i--) {
//     console.log(i)
// }
