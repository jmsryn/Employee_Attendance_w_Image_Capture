let one = document.getElementById('1');
let two = document.getElementById('2');
let three = document.getElementById('3');
let four = document.getElementById('4');
let five = document.getElementById('5');
let six = document.getElementById('6');
let seven = document.getElementById('7');
let eight = document.getElementById('8');
let nine = document.getElementById('9');
let zero = document.getElementById('0');
let idNum = document.getElementById('idnum');


one.addEventListener('click', function(){
    var data = idNum.value
    var custom = data + "1"
    idNum.value = custom
})

two.addEventListener('click', function(){
    var data = idNum.value
    var custom = data + "2"
    idNum.value = custom
})

three.addEventListener('click', function(){
    var data = idNum.value
    var custom = data + "3"
    idNum.value = custom
})

four.addEventListener('click', function(){
    var data = idNum.value
    var custom = data + "4"
    idNum.value = custom
})

five.addEventListener('click', function(){
    var data = idNum.value
    var custom = data + "5"
    idNum.value = custom
})

six.addEventListener('click', function(){
    var data = idNum.value
    var custom = data + "6"
    idNum.value = custom
})

seven.addEventListener('click', function(){
    var data = idNum.value
    var custom = data + "7"
    idNum.value = custom
})

eight.addEventListener('click', function(){
    var data = idNum.value
    var custom = data + "8"
    idNum.value = custom
})

nine.addEventListener('click', function(){
    var data = idNum.value
    var custom = data + "9"
    idNum.value = custom
})

zero.addEventListener('click', function(){
    var data = idNum.value
    var custom = data + "0"
    idNum.value = custom
})

// del.addEventListener('click', function(){
//     var data = idNum.value
//     var deleted = data.substring(0, data.length - 1)
//     idNum.value = deleted
// })