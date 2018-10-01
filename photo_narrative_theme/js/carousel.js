const ERROR_BAD_LENGTH = new Error("Length parameter must be a number greater than 0 (inclusive).");
const ERROR_BAD_INDEX = new Error("Index parameter must be a number greater than 0 (inclusive).");
const ERROR_BAD_WAIT_TIME = new Error("WaitTime parameter must be a positive number greater than 0 (exclusive).");
const ERROR_BAD_QUERY_SELECTOR = new Error("QuerySelector parameter must be a string.");
const ERROR_NOT_FOUND = new Error("Couldn't find element specified by Query Selector.");


class Carousel {
    constructor(length, currentIndex, waitTime, querySelector) {
        if(!isNaN(length) && length < 0) {
            throw ERROR_BAD_LENGTH;
        }
        else if(!isNaN(currentIndex) && currentIndex < 0) {
            throw ERROR_BAD_INDEX;
        }
        else if(!isNaN(waitTime) && waitTime <= 0) {
            throw ERROR_BAD_WAIT_TIME;
        }
        else if(querySelector && typeof querySelector !== "string") {
            throw ERROR_BAD_QUERY_SELECTOR;
        }

        this._length = length || 0;
        this._currentIndex = currentIndex || 0;
        this._waitTime = waitTime || 5000;
        this._querySelector = querySelector || "";
    }

    length(newLength) {
        if(newLength === undefined) { //get
            return this._length;
        }
        else { //set
            if(isNaN(newLength) || newLength < 0) {
                throw ERROR_BAD_LENGTH;
            }

            this._length = newLength;
        }
    }

    currentIndex(newIndex) {
        if(newIndex === undefined) { //get
            return this._currentIndex;
        }
        else { //set
            if(isNaN(newIndex) || newIndex < 0 || newIndex >= this._length) {
                throw ERROR_BAD_INDEX;
            }
            this._currentIndex = newIndex;
        }

        this.goToSlide(this._currentIndex);
    }

    waitTime(newTime) {
        if(newTime === undefined) { //get
            return this._waitTime;
        }
        else { //set
            if(isNaN(newTime) || newTime < 0) {
                throw ERROR_BAD_WAIT_TIME;
            }
            this._waitTime = newTime;
        }
    }

    querySelector(newSelector) {
        if(newSelector === undefined) { //get
            return this._querySelector;
        }
        else { //set
            if(typeof newSelector !== "string") {
                throw ERROR_BAD_QUERY_SELECTOR;
            }
            this._querySelector = newSelector;
        }
    }

    nextSlide() {
        this._currentIndex++;

        if(this._currentIndex >= this._length) {
            this._currentIndex = 0;
        }

        //DOM manipulation goes here
        this.goToSlide(this._currentIndex);
    }

    prevSlide() {
        this._currentIndex--;

        if(this._currentIndex < 0) {
            this._currentIndex = this._length - 1;
        }

        //DOM manipulation goes here
        this.goToSlide(this._currentIndex);
    }

    goToSlide(i) {
        if(isNaN(i) || i < 0 || i >= this._length) {
            throw ERROR_BAD_INDEX;
        }

        const carouselListElement = document.querySelector(this._querySelector);
        var slideButton;

        if(!carouselListElement) {
            throw ERROR_NOT_FOUND;
        }

        for(let j = 0; j < this._length; j++) {
            slideButton = document.querySelector(`#slideButton${j}`);

            if(slideButton && j !== i) {
                slideButton.classList.remove("active");
            }
            else if(slideButton && j === i) {
                slideButton.classList.add("active");
            }
        }

        carouselListElement.classList.remove("slide0", "slide1", "slide2", "slide3", "slide4");
        carouselListElement.classList.add(`slide${i}`);
    }
}

var HomePageCarousel = new Carousel();