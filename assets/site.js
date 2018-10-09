$(document).ready(function(){
    $('.prices').each(function(index,item){var minBodyHeight=1000;$(item).find('div.plan-body').each(function(index,price){var priceHeight=$(price).height();if(minBodyHeight>priceHeight)minBodyHeight=priceHeight;});var maxHeaderHeight=0;$(item).find('div.plan-header').each(function(index,price){var priceHeight=$(price).height();if(maxHeaderHeight<priceHeight)maxHeaderHeight=priceHeight;});$(item).find('div.plan-body').each(function(index,price){$(price).css({height:minBodyHeight+maxHeaderHeight});});});$('.plan').hover(function(){$(this).addClass('animated infinite pulse');},function(){$(this).removeClass('animated infinite pulse');});$('#callButton').hover(function(){$(this).addClass('animated shake');},function(){$(this).removeClass('animated shake');$(this).addClass('animated infinite pulse');});$('.infos > .card > .panel-item > .card-img').hover(function(){$(this).addClass('animated swing');},function(){$(this).removeClass('animated swing');});$(function(){var form=$('#contact-form');var name=$('#name');var email=$('#email');var phone=$('#phone');var message=$('#message');$(form).submit(function(event){event.preventDefault();var formData=$(form).serialize();$.ajax({type:'POST',url:$(form).attr('action'),data:formData}).done(function(response){$(form).hide();$('#successMessage h3').text(response);$('#successMessage').show();$('#name').val('');$('#email').val('');$('#phone').val('');$('#message').val('');}).fail(function(data){$('#errorMessage h3').text(data.responseText);$('#errorMessage').show();});});});
    $("#payModal").on('show.bs.modal', function(e){
        var b = $(e.relatedTarget);
        var p = b.data("price");
        var d = b.data("description");
        var m = $(this);
        m.find('input[name="amount"]').val(p);
        m.find('input[name="description"]').val(d);
    });
});

