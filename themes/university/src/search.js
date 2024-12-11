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
    if (e) {
      e.preventDefault();
    }
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
      // let searchPost = await axios({
      //   method: "GET",
      //   url: `${globalData.url}/wp-json/wp/v2/posts?search=${term}`,
      // });
      // let searchPages = await axios({
      //   method: "GET",
      //   url: `${globalData.url}/wp-json/wp/v2/pages?search=${term}`,
      // });

      let globalSearch = await axios({
        method: "GET",
        url: `${globalData.url}/wp-json/university/v1/search?term=${term}`,
      });

      // if (searchPost.data && searchPages.data) {
      // let results = [...searchPages.data, ...searchPost.data];
      if (globalSearch.data) {
        let results = globalSearch.data;

        let content = "";
        let generalResults = [...results.page, ...results.post];
        let program = results.program;
        let professor = results.professor;
        let campus = results.campus;
        let event = results.event;

        if (generalResults.length > 0) {
          content += `
            <div  class="col-md-6  mt-2 ">
						<div class="card">
							<div class="card-body">
								<h4>General information</h4> <div>
									<ul class="m-0">
                                    ${generalResults
                                      .map(function (i) {
                                        return `<li> 
                                        <a href="${i.url}"> ${i.title}  </a>
                                         ${
                                           i.type == "post"
                                             ? ` By ${i.authorName} `
                                             : ""
                                         }
                                        </li>`;
                                      })
                                      .join("")}
										
									</ul> </div> </div> </div> </div>`;
        } else {
          content += `
              <div  class="col-md-6   mt-2   ">
              <div class="card">
							<div class="card-body">
              <h4>General information</h4>
              <p> No results found for the query </p>
              </div> </div> </div>`;
        }

        if (program.length > 0) {
          content += `
            <div  class="col-md-6  mt-2 ">
						<div class="card">
							<div class="card-body">
								<h4>Programs</h4> <div>
									<ul class="m-0">
                                    ${program
                                      .map(function (i) {
                                        return `<li> 
                                        <a href="${i.url}"> ${i.title}  </a>
                                          
                                        </li>`;
                                      })
                                      .join("")}
										
									</ul> </div> </div> </div> </div>`;
        } else {
          content += `
              <div  class="col-md-6   mt-2   ">
              <div class="card">
							<div class="card-body">
              <h4>Programs</h4>
              <p> No results found for the query </p>
              </div> </div> </div>`;
        }

        if (professor.length > 0) {
          content += `
            <div  class="col-md-6  mt-2 ">
						<div class="card">
							<div class="card-body">
								<h4>Professors</h4> <div>
									<ul class="m-0">
                                    ${professor
                                      .map(function (i) {
                                        return `<li> 
                                        <a href="${i.url}"> ${i.title} 
                                        <img style="height:60px" class="img-thumbnail img-fluid" src="${i.image}" alt="${i.title}" />
                                        </a>
                                          
                                        </li>`;
                                      })
                                      .join("")}
										
									</ul> </div> </div> </div> </div>`;
        } else {
          content += `
              <div  class="col-md-6   mt-2   ">
              <div class="card">
							<div class="card-body">
              <h4>Professors</h4>
              <p> No results found for the query </p>
              </div> </div> </div>`;
        }

        if (campus.length > 0) {
          content += `
            <div  class="col-md-6  mt-2 ">
						<div class="card">
							<div class="card-body">
								<h4>Campuses</h4> <div>
									<ul class="m-0">
                                    ${campus
                                      .map(function (i) {
                                        return `<li> 
                                        <a href="${i.url}"> ${i.title} 
                                        </a>
                                          
                                        </li>`;
                                      })
                                      .join("")}
										
									</ul> </div> </div> </div> </div>`;
        } else {
          content += `
              <div  class="col-md-6   mt-2   ">
              <div class="card">
							<div class="card-body">
              <h4>Campuses</h4>
              <p> No results found for the query </p>
              </div> </div> </div>`;
        }

        if (event.length > 0) {
          content += `
            <div  class="col-md-6  mt-2 ">
						<div class="card">
							<div class="card-body">
								<h4>Events</h4> <div>
									<ul class="m-0">
                                    ${event
                                      .map(function (i) {
                                        return `<li> 
                                        <a href="${i.url}"> ${i.title} 
                                        </a>
                                          
                                        </li>`;
                                      })
                                      .join("")}
										
									</ul> </div> </div> </div> </div>`;
        } else {
          content += `
              <div  class="col-md-6   mt-2   ">
              <div class="card">
							<div class="card-body">
              <h4>Events</h4>
              <p> No results found for the query </p>
              </div> </div> </div>`;
        }

        this.populateContent(content);
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
