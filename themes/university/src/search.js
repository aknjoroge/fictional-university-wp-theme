class Search {
  constructor() {
    this.searchTrigger = document.getElementById("search-trigger");
    this.searchModal = new bootstrap.Modal(
      document.getElementById("searchModal")
    );
    this.searchField = document.getElementById("searchField");
    this.modalShown = false;
  }

  events() {
    document.addEventListener(
      "keyup",
      function (e) {
        if (
          e.keyCode == 83 &&
          e.key == "s" &&
          !this.searchModal._isShown &&
          !this.isTextBoxInFocus()
        ) {
          this.searchModal.show();
        }
      }.bind(this)
    );

    this.searchTrigger.addEventListener("click", (e) => {
      this.searchModal.show();

      setTimeout(() => {
        this.searchField.focus();
      }, 500);
    });
  }

  isTextBoxInFocus() {
    const activeElement = document.activeElement;

    return (
      activeElement.tagName === "INPUT" ||
      activeElement.tagName === "TEXTAREA" ||
      activeElement.isContentEditable
    );
  }
}

export default Search;
