 $(document).ready(function() {
    $('#btn_do').bind('click', function() { checkDo(); });
});
function checkDo(){
    $('#dotab').hide();
    $('#dodiv').show();
    document.doform.submit();
}