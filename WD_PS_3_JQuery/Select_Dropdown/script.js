const SELECT_DATA = [{
    name: 'Select',
    images: 'images/filtering_1.png'
  },
  {
    name: 'USA',
    images: 'images/icons8-usa-48.png'
  },
  {
    name: 'Latvia',
    images: 'images/icons8-latvia-48.png'
  },
  {
    name: 'Netherlands',
    images: 'images/icons8-netherlands-48.png'
  },
  {
    name: 'Poland',
    images: 'images/icons8-poland-48.png'
  },
  {
    name: 'Romania',
    images: 'images/icons8-romania-48.png'
  },
  {
    name: 'Spain',
    images: 'images/icons8-spain-48.png'
  },
  {
    name: 'Thailand',
    images: 'images/icons8-thailand-48.png'
  },
  {
    name: 'Ukraine',
    images: 'images/icons8-ukraine-48.png'
  }
];

let flag = true;

$(document).ready(function() {
  const item = $(".select_item");
  const select_main_wrapper = $('.select_main_wrapper');
  let counter = 1;


  for (let x of SELECT_DATA) {
    if (x.name === "Select") {
      continue;
    }
    let newItem = $('<div id="select_item_' + counter + '" class="select_item"></div')
      .append($('<img id="select_item_' + counter + '" class="image" src="' + x.images + '">'))
      .append($('<span id="select_item_' + counter + '">' + x.name + '</span>'))
      .attr("id", "select_item_" + counter)
      .addClass("visible_item");
    select_main_wrapper.append(newItem);
    counter++;
  }



  $('.select_item').on("click", function(event) {
    let currentItem;
    let text = "";
    const item = $(event.target);
    const id = item.attr("id");
    const arr_items = $(".select_main_wrapper").find("div");
    if (flag) {
      for (let i = 0; i < arr_items.length; i++) {
        if (i !== 0) {
          $(arr_items[i]).css("margin", "2px auto");
        }
        currentItem = $(arr_items[i]).attr("id");
        $('#' + currentItem).removeClass("visible_item");
      }
      select_main_wrapper.css("border", "1px solid blue");
      $('.select_item:first-child').css('margin-top', '1px');
      flag = false;
    } else {
        for (let i = 0; i < arr_items.length; i++) {
          if (i == 0) {
            let arrElem = $('div[id="' + id + '"]').children();
            text += $('div[id="' + id + '"]').html();
            $('#select_item_0').html(text);
          }

          if ($(arr_items[i]).attr("id") !== id) {
            currentItem = $(arr_items[i]).attr("id");
            $('#' + currentItem).slideToggle('slow');
          }
        }
        add_styles(this);
        flag = false;
    }
  });

  function add_styles(item) {
    $(item).css("margin", "2px auto");
    select_main_wrapper.css("border", "none");
  }


  $('.select_item').hover(
    function() {
      $(this).css({
        "background-color": "rgb(124, 186, 226, 0.7)",
        "cursor": "pointer"
      });
    },
    function() {
      $(this).css({
        "background-color": "rgba(171, 184, 142, 0.5)",
      });
    }
  );
});