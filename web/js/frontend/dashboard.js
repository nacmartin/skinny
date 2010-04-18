$(document).ready(function()
{
  var toggleTodo = function(){
    var header = $(this).hasClass(".header") ? $(this) : $(this).closest(".todo").find(".ui-widget-header:first");
    var todo = header.closest(".todo");
    var content = header.next();
    if (!header.hasClass("ui-state-active"))
    {
      todo.addClass("active");
      header
        .removeClass("ui-corner-all ui-state-default")
        .addClass("ui-state-active ui-corner-top")
        ;
      content
        .slideDown("fast")
        .addClass("ui-content-active")
        ;
    }
    else
    {
      todo.removeClass("active");
      header
        .removeClass("ui-state-active ui-corner-top")
        .addClass("ui-corner-all ui-state-default")
        ;
      content
        .slideUp("fast")
        ;
    }

    return false;
  };

  $(".item-header").live("click", toggleTodo);
  $(".item-header").live("mouseover", function(){
        if (!$(this).hasClass("ui-state-disabled"))
        {
          $(this).addClass("ui-state-hover");
        }
      });

  $(".item-header").live("mouseout", function(){
        $(this).removeClass("ui-state-hover");
      });

  $("#todo .item-header .check")
    .live('click',function(){
      var header = $(this).closest(".ui-widget-header");
      var content = header.next();
      id = header.parent().parent().attr('id').substring(5);
      if (header.hasClass("ui-state-disabled"))
      {
        uncheck(id);
        header.removeClass("ui-state-disabled");
        content.removeClass("ui-state-disabled");
      }
      else
      {
        check(id);
        header.addClass("ui-state-disabled");
        content.addClass("ui-state-disabled");
      }
      return false;
    }) ;

  $(".top a").click(toggleTodo).find(".txt").text("close");
  $(".tagList li:first").addClass("checked");
  $(".tagList li").click(function(){
    $(".tagList li").removeClass("checked");
    if ("all" === this.className)
    {
      $("#todo .todo").show();
    }
    else
    {
      $("#todo .todo."+this.className).show();
      $("#todo .todo:not(."+this.className+")").hide();
    }
    $(this).addClass("checked");
  });
});
