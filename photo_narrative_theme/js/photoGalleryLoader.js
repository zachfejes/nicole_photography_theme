class PhotoGalleryLoader {
    constructor(numberOfPhotos, targetElementSelector) {
        this._numberOfPhotos = numberOfPhotos || undefined;
        this._loaded = [];
        this._targetElementSelector = "";

        if(numberOfPhotos > 0) {
            for(let i = 0; i < numberOfPhotos; i++) {
                this._loaded.push(false);
            }
        }

        if(targetElementSelector && typeof targetElementSelector === "string") {
            this._targetElementSelector = targetElementSelector;
        }
    }

    get numberOfPhotos() {
        return this._numberOfPhotos;
    }

    set numberOfPhotos(number) {
        if(isNaN(number)) {
            throw new Error("Must provide a number as a parameter.");
        }

        this._loaded = [];

        for(let i = 0; i < number; i++) {
            this._loaded.push(false);
        }

        this._numberOfPhotos = number;
    }

    get loaded() {
        return this._loaded;
    }

    set loaded(newLoaded) {
        if(!Array.isArray(newLoaded)) {
            throw new Error("Provided parameter must be an array");
        }

        this._loaded = newLoaded;
    }

    get targetElementSelector() {
        return this._targetElementSelector;
    }

    set targetElementSelector(newSelector) {
        if(typeof newSelector !== "string") {
            throw new Error("targetElementSelector must be a string");
        }

        this._targetElementSelector = newSelector;
    }

    setLoadedByIndex(isLoaded, index) {
        if(isNaN(index) || index > this._loaded.length - 1 || index < 0) {
            throw new Error("Index must be within the range of the loaded array");
        }

        this._loaded[index] = isLoaded;

        if(this._loaded.every(x => x)) {
            let galleryElement = document.querySelector(this._targetElementSelector);

            if(galleryElement) {
                galleryElement.classList.remove("loading");
            }
        }
    }
}