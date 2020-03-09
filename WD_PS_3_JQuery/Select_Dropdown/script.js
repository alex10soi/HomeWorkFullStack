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


$(document).ready(function() {
  const item = $(".select_item");
  const drop_down_list = $('.drop_down_list');
  const select_wrapper = $('.select_wrapper');

  let counter = 1;
  for (let x of SELECT_DATA) {
    let newItem = $('<div id="select_item_' + counter + '"" class="select_item_list"></div')
      .append($('<img id="select_item_' + counter + '" class="image" src="' + x.images + '">'))
      .append($('<span id="select_item_' + counter + '">' + x.name + '</span>'));
    drop_down_list.append(newItem);
    counter++;
  }

  let flag = true;

  // Collapses Drop Down after selecting an item and changes the values ​​in the title 
  //item to the values ​​of the selected item.
  $('#select_item_0').click(()=> {
    if(flag){
      drop_down_list.slideDown();
      $('.fa-angle-down').addClass('rotate_icon');
      flag = !flag; 
    }else{
      drop_down_list.slideUp();
      $('.fa-angle-down').removeClass('rotate_icon');
      flag = !flag; 
    }
  });

  $('.select_item_list').click((event)=> {
    const src = $('img[id="' + event.target.id + '"').attr('src');
    const spanValue = $('span[id="' + event.target.id + '"')[0].innerText;
   
    $('img[id=select_item_0').attr('src', src);
    $('span[id=select_item_0').text(spanValue);
    drop_down_list.slideUp();
    $('.fa-angle-down').removeClass('rotate_icon');
    flag = !flag; 
  });

  
  // Collapses Drop Down when the user leaves the Drop Down area of ​​the sheet
  select_wrapper.mouseleave(()=> {
    drop_down_list.slideUp();
    $('.fa-angle-down').removeClass('rotate_icon');
    flag = !flag; 
  });


  // Changes the color of items in the list when you hover over an item and leave its area.
  $(".select_item, .select_item_list").hover(
    (item)=> {
      $("#" + item.currentTarget.id).css({
        "background-color": "rgb(124, 186, 226, 0.2)"
      });
    },
    (item)=> {
      $("#" + item.currentTarget.id).css({
        "background-color": "rgba(171, 184, 142, 0.5)",
      });
    }
  );

  // -----------------------------------------------------

});