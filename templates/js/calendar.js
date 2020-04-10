function Calendar2(id, year, month) {
    let
        i,
        DayLast = new Date(year,month+1,0).getDate(),
        Day = new Date(year,month,DayLast),
        DNlast = new Date(Day.getFullYear(),Day.getMonth(),DayLast).getDay(),
        DNfirst = new Date(Day.getFullYear(),Day.getMonth(),1).getDay(),
        calendar = '<tr>';
        month=["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"];
    if (DNfirst !== 0) {
        for(i = 1; i < DNfirst; i++) calendar += '<td>';
    }else{
        for(i = 0; i < 6; i++) calendar += '<td>';
    }
    for(i = 1; i <= DayLast; i++) {
        if (i === new Date().getDate() && Day.getFullYear() === new Date().getFullYear() && Day.getMonth() === new Date().getMonth()) {
            calendar += '<td class="today">' + i;
        }else{
            calendar += '<td>' + i;
        }
        if (new Date(Day.getFullYear(),Day.getMonth(),i).getDay() === 0) {
            calendar += '<tr>';
        }
    }
    for(i = DNlast; i < 7; i++) calendar += '<td>&nbsp;';
    document.querySelector('#'+id+' tbody').innerHTML = calendar;
    document.querySelector('#'+id+' thead td:nth-child(2)').innerHTML = month[Day.getMonth()] +' '+ Day.getFullYear();
    document.querySelector('#'+id+' thead td:nth-child(2)').dataset.month = Day.getMonth();
    document.querySelector('#'+id+' thead td:nth-child(2)').dataset.year = Day.getFullYear();
    // чтобы при перелистывании месяцев не "подпрыгивала" вся страница, добавляется ряд пустых клеток. Итог: всегда 6 строк для цифр
    if (document.querySelectorAll('#'+id+' tbody tr').length < 6) {
        document.querySelector('#'+id+' tbody').innerHTML += '<tr><td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;<td>&nbsp;';
    }
}
Calendar2("calendar2", new Date().getFullYear(), new Date().getMonth());
// переключатель минус месяц
document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(1)').onclick = function() {
    Calendar2("calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)-1);
}
// переключатель плюс месяц
document.querySelector('#calendar2 thead tr:nth-child(1) td:nth-child(3)').onclick = function() {
    Calendar2("calendar2", document.querySelector('#calendar2 thead td:nth-child(2)').dataset.year, parseFloat(document.querySelector('#calendar2 thead td:nth-child(2)').dataset.month)+1);
}
