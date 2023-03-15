function getLogs(core, key, log, success, error){
    $.ajax({
        url: '/frontend/web/tools/logs',
        type: 'post',
        dataType: 'html',
        data: { 'core': core, 'key': key, 'log': log, 'success': success, 'error': error },
        error: function (response){
            alert("Упс! Кажется произошла ошибка при загрузке данных. Пожалуйста, перезагрузите страницу или попробуйте позже!\\n\\nОтвет ошибки:\\n" + response['responseText']);
            console.log(response);
        }
    });
}