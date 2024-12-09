import axios from "axios";

class Search {
  constructor() {
    this.searchTrigger = document.getElementById("search-trigger");
    this.searchModal = new bootstrap.Modal(
      document.getElementById("searchModal")
    );
    this.searchField = document.getElementById("searchField");
    this.searchResults = document.getElementById("search-results");
    this.modalShown = false;
    this.spinnerShown = false;
    this.searchTimer = null;
    this.searchValue = null;
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
          this.openSearchModal();
        }
      }.bind(this)
    );

    this.searchTrigger.addEventListener(
      "click",
      this.openSearchModal.bind(this)
    );

    this.searchField.addEventListener("keyup", () => {
      clearTimeout(this.searchTimer);

      if (this.searchValue != this.searchField.value && !this.spinnerShown) {
        this.spinnerShown = true;
        this.searchResults.innerHTML = `
             <div  class="col-md-12  mt-2 text-center ">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            </div>`;
      }

      this.searchTimer = setTimeout(() => {
        if (this.searchField.value) {
          if (this.searchValue != this.searchField.value) {
            this.searchValue = this.searchField.value;
            this.searchQuery(this.searchField.value);
          }
        } else {
          this.populateContent("");

          this.searchValue = null;
        }
      }, 800);
    });
  }

  openSearchModal(e) {
    this.searchField.value = "";
    this.searchModal.show();
    setTimeout(() => {
      this.searchField.focus();
    }, 500);
  }

  isTextBoxInFocus() {
    const activeElement = document.activeElement;
    return (
      activeElement.tagName === "INPUT" ||
      activeElement.tagName === "TEXTAREA" ||
      activeElement.isContentEditable
    );
  }

  async searchQuery(term) {
    try {
      let searchPost = await axios({
        method: "GET",
        url: `http://localhost:8888/FictionalUniversity/wp-json/wp/v2/posts?search=${term}`,
      });
      let searchPages = await axios({
        method: "GET",
        url: `http://localhost:8888/FictionalUniversity/wp-json/wp/v2/pages?search=${term}`,
      });

      if (searchPost.data && searchPages.data) {
        let results = [...searchPages.data, ...searchPost.data];

        if (results.length > 0) {
          let content = `
            <div  class="col-md-6  mt-2 ">
						<div class="card">
							<div class="card-body">

								<h4>General information</h4>

								<div>
									<ul class="m-0">
                                    ${results
                                      .map(function (i) {
                                        return `<li> 
                                        <a href="${i.link}"> ${
                                          i.title?.rendered
                                        }  </a>
                                         ${
                                           i.type == "post"
                                             ? " By <a href=#>Author </a>"
                                             : ""
                                         }
                                        </li>`;
                                      })
                                      .join("")}
										
									</ul>

								</div>

							</div>

						</div>
					</div>`;

          this.populateContent(content);
        } else {
          this.populateContent(`
              <div  class="col-md-12  mt-2 text-center ">

             <p> No results found for the query </p>
    
              
              </div>`);
        }
      }
    } catch (error) {
      console.log("error", error);
    }
  }

  populateContent(markup) {
    this.searchResults.innerHTML = markup;
    this.spinnerShown = false;
  }
}

export default Search;
