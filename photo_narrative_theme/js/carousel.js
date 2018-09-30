const ERROR_BAD_LENGTH = new Error("Length parameter must be a number greater than 0 (inclusive).");
const ERROR_BAD_INDEX = new Error("Index parameter must be a number greater than 0 (inclusive).");
const ERROR_BAD_WAIT_TIME = new Error("WaitTime parameter must be a positive number greater than 0 (exclusive).");
const ERROR_BAD_QUERY_SELECTOR = new Error("QuerySelector parameter must be a string.");


class Carousel {
    constructor(length, currentIndex, waitTime, querySelector) {
        this._length = 0;
        this._currentIndex = 0;
        this._waitTime = 5000;
        this._querySelector = "";

        if(isNaN(length) || length < 0) {
            throw ERROR_BAD_LENGTH;
        }
        else if(isNaN(currentIndex) || currentIndex < 0) {
            throw ERROR_BAD_INDEX;
        }
        else if(isNaN(waitTime) || waitTime <= 0) {
            throw ERROR_BAD_WAIT_TIME;
        }
        else if(!querySelector || typeof querySelector !== "string") {
            throw ERROR_BAD_QUERY_SELECTOR;
        }

        this._length = length;
        this._currentIndex = currentIndex;
        this._waitTime = waitTime;
        this._querySelector = querySelector;
    }
}