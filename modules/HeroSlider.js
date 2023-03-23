import $ from 'jquery';

class HeroSlider {
  constructor() {
    this.els = $(".heroslider");
    this.initSlider();
  }

  initSlider() {
    this.els.slick({
      autoplay: true,
      arrows: false,
      dots: true
    });
  }
}

export default HeroSlider;