class PhotoGalleryLoader {
    constructor(numberOfPhotos, targetElementSelector) {
        this.initialize(numberOfPhotos, targetElementSelector);
    }

    initialize(numberOfPhotos, targetElementSelector) {
        this._numberOfPhotos = numberOfPhotos || undefined;
        this._loaded = [];
        this._targetElementSelector = "";

        if(!isNaN(numberOfPhotos) && numberOfPhotos >= 0) {
            this._numberOfPhotos = numberOfPhotos;

            for(let i = 0; i < numberOfPhotos; i++) {
                this._loaded.push(false);
            }
        }

        if(targetElementSelector && typeof targetElementSelector === "string") {
            this._targetElementSelector = targetElementSelector;
        }

        console.log("I, the photoGalleryLoader, have been created. I have " + this._numberOfPhotos + " images to load.");
    }

    numberOfPhotos(number) {
        if(number === undefined) { //get
            return this._numberOfPhotos;
        }
        else { //set
            console.log("I have been asked to prepare " + number + " to be loaded.");

            this._loaded = [];

            for(let i = 0; i < number; i++) {
                this._loaded.push(false);
            }

            this._numberOfPhotos = number;
        }
    }

    loaded() {
        return this._loaded;
    }

    loaded(newLoaded) {
        if(newLoaded === undefined) { //get
            return this._loaded;
        }
        else { //set
            if(!Array.isArray(newLoaded)) {
                throw new Error("Provided parameter must be an array");
            }
            this._loaded = newLoaded;
        }
    }

    get targetElementSelector() {
        return this._targetElementSelector;
    }

    targetElementSelector(newSelector) {
        if(newSelector === undefined) { //get
            return this._targetElementSelector;
        }
        else { //set
            if(typeof newSelector !== "string") {
                throw new Error("targetElementSelector must be a string");
            }

            this._targetElementSelector = newSelector;
        }
    }

    setLoadedByIndex(isLoaded, index) {
        console.log("setLoadedByIndex -> index: " + index + " , is loaded: ", isLoaded);

        if(isNaN(index) || index > this._loaded.length - 1 || index < 0) {
            throw new Error("Index must be within the range of the loaded array");
        }

        this._loaded[index] = isLoaded;

        if(this._loaded.every(x => x)) {
            console.log("everything is loaded!");

            let galleryElement = document.querySelector(this._targetElementSelector);
            console.log("galleryElement: ", galleryElement);
            if(galleryElement) {
                galleryElement.classList.remove("loading");
            }
        }
    }
}

var GalleryLoader = new PhotoGalleryLoader(0);
