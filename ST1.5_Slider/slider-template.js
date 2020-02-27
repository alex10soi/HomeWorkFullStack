const API_URL = 'https://picsum.photos/';
const BIG_SIZE = '600/400';
const SMALL_SIZE = '60';

const IMAGES = [
  '?image=1080',
  '?image=1079',
  '?image=1069',
  '?image=1063',
  '?image=1050',
  '?image=1039'
];

$(document).ready(function() {
  const ulList = $(".slider-previews");
  ulList.css("padding-left", "0");

  IMAGES.forEach(function(path) {
    let newLiImg = $(`<li class="slider-previews-item"><img 
      src=" ${API_URL + SMALL_SIZE + path}" alt="image"</li>`);
    ulList.append(newLiImg);
  });

  moveframeToImg($('.slider-previews li').first());

  $('.slider-previews li').on("click", function() {
    moveframeToImg($(this));
    changeMainImg($(this).children());
  });


  function moveframeToImg(newCurrent_li) {
    $('.current').removeClass("current");
    newCurrent_li.addClass("current");
  }
  

  function changeMainImg(img) {
    $(".slider-current img").attr("src", img.attr("src").replace(SMALL_SIZE, BIG_SIZE));
  }


  $(document).on('keydown', (event)=>{
    let nextLi;
  
    if(event.keyCode === 39){  // вправо 
      if($('.slider-previews li').last().hasClass('current')){
        nextLi = $('.slider-previews li').first();
        moveframeToImg(nextLi);
        changeMainImg($(nextLi).children());
      }else{
        nextLi = $('li.current').next();
        moveframeToImg(nextLi);
        changeMainImg(nextLi.children());
      }
    }else if(event.keyCode === 37){  // влево
      if($('.slider-previews li').first().hasClass('current')){
        nextLi = $('.slider-previews li').last();
        moveframeToImg(nextLi);
        changeMainImg($(nextLi).children());
      }else{
        nextLi = $('li.current').prev();
        moveframeToImg(nextLi);
        changeMainImg(nextLi.children());
      }
    }
  });
});