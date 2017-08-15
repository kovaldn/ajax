console.log('in common.js'); // убедимся, что мы подключили js файл
console.log($); // убедимся, что мы подключили jQuery

// сабмит формы
var submitForm = function (ev) {
    
    console.log('in submitForm'); // убедимся, что функция запущена
   
    ev.preventDefault(); // отменяем действие по умолчанию
    
    var form = $(this); // this - это форма. Обернув её в $() мы превратили форму в jquery объект         
   
    // вызываем функцию ajaxForm. И к результату вызова функции применяем 2 метода: done и fail 
    // ans - это ответ, полученный от сервера
    ajaxForm(form).done(function(ans) {
       
        console.log(ans);
       
        // Сервер возврати данные в формате JSON, 
        // Ответ содержит СТАТУС ('status') и СООБЩЕНИЕ ('mes')
        var mes = ans.mes,
            status = ans.status;

        if ( status === 'OK') {
            alert(mes);           
        } else{
            alert(mes);
        }
    
    }).fail(function() { // Сработает в том случае, если не удалось выполнить AJAX запрос
        alert('Сервер не отвечает!');
    });

};

// отправка данных на сервер и получение ответа
var ajaxForm = function (form) {  
    
    var data = form.serialize(), // подготовка данных для отправки на сервер (url нотация)
        url = form.attr('action'); // url берем из самой формы!

    console.log(url);
    console.log(data);

    return $.ajax({
        type: 'POST',
        url: url,
        dataType : 'JSON',
        data: data
    })
};   

// вешаем обработчик собятия
$('#order-form').on('submit', submitForm);