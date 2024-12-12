import axios from "axios";

class Notes {
  constructor() {
    this.endPoint = `${globalData.url}/wp-json/wp/v2/note`;
    this.noteForm = document.getElementById("note-form");
    this.noteContainer = document.getElementById("note-container");
  }

  events() {
    // Buttons
    const editBtns = this.noteContainer.querySelectorAll(".edit-btn");
    const deleteBtns = this.noteContainer.querySelectorAll(".delete-btn");
    const cancelBtns = this.noteContainer.querySelectorAll(".cancel-btn");
    const saveBtns = this.noteContainer.querySelectorAll(".save-btn");

    editBtns.forEach(
      function (e) {
        e.addEventListener("click", this.editNote.bind(this));
      }.bind(this)
    );

    cancelBtns.forEach(
      function (e) {
        e.addEventListener("click", this.cancelEdit.bind(this));
      }.bind(this)
    );
    deleteBtns.forEach(
      function (e) {
        e.addEventListener("click", this.deleteNote.bind(this));
      }.bind(this)
    );
    saveBtns.forEach(
      function (e) {
        e.addEventListener("click", this.saveNote.bind(this));
      }.bind(this)
    );

    this.noteForm.addEventListener("submit", this.addNote.bind(this));
  }

  editNote(e) {
    const clickedElement = e.target;

    const note = clickedElement.closest(".note");

    if (note) {
      const editBtn = note.querySelector(".edit-btn");
      const cancelBtn = note.querySelector(".cancel-btn");
      const saveBtn = note.querySelector(".save-btn");
      const deleteBtn = note.querySelector(".delete-btn");
      const noteTitle = note.querySelector(".note-title");
      const noteContent = note.querySelector(".note-content");

      editBtn.classList.add("hidden");
      deleteBtn.classList.add("hidden");
      cancelBtn.classList.remove("hidden");
      saveBtn.classList.remove("hidden");

      noteTitle.removeAttribute("readonly");
      noteTitle.classList.remove("border-0");

      noteContent.removeAttribute("readonly");
      noteContent.classList.remove("border-0");
    }
  }

  cancelEdit(e) {
    const clickedElement = e.target;

    const note = clickedElement.closest(".note");

    if (note) {
      const editBtn = note.querySelector(".edit-btn");
      const cancelBtn = note.querySelector(".cancel-btn");
      const deleteBtn = note.querySelector(".delete-btn");
      const saveBtn = note.querySelector(".save-btn");
      const noteTitle = note.querySelector(".note-title");
      const noteContent = note.querySelector(".note-content");

      editBtn.classList.remove("hidden");
      deleteBtn.classList.remove("hidden");
      cancelBtn.classList.add("hidden");
      saveBtn.classList.add("hidden");

      noteTitle.setAttribute("readonly", true);
      noteTitle.classList.add("border-0");

      noteContent.setAttribute("readonly", true);
      noteContent.classList.add("border-0");
    }
  }

  async saveNote(e) {
    const clickedElement = e.target;

    const note = clickedElement.closest(".note");

    if (note) {
      const editBtn = note.querySelector(".edit-btn");
      const cancelBtn = note.querySelector(".cancel-btn");
      const deleteBtn = note.querySelector(".delete-btn");
      const saveBtn = note.querySelector(".save-btn");
      const noteTitle = note.querySelector(".note-title");
      const noteContent = note.querySelector(".note-content");

      const id = note.dataset.id;

      try {
        let response = await axios({
          method: "PATCH",
          data: {
            title: noteTitle.value,
            content: noteContent.value,
          },
          url: `${this.endPoint}/${id}`,
          headers: {
            "X-WP-Nonce": globalData.nonce,
          },
        });

        deleteBtn.classList.remove("hidden");
        editBtn.classList.remove("hidden");
        cancelBtn.classList.add("hidden");
        saveBtn.classList.add("hidden");

        noteTitle.setAttribute("readonly", true);
        noteTitle.classList.add("border-0");

        noteContent.setAttribute("readonly", true);
        noteContent.classList.add("border-0");
      } catch (error) {
        let { message } = error;
        alert(message);
      }
    }
  }

  async deleteNote(e) {
    const clickedElement = e.target;

    const note = clickedElement.closest(".note");

    if (note) {
      const id = note.dataset.id;

      try {
        let response = await axios({
          method: "DELETE",
          url: `${this.endPoint}/${id}`,
          headers: {
            "X-WP-Nonce": globalData.nonce,
          },
        });

        note.remove();
      } catch (error) {
        let { message } = error;
        alert(message);
      }

      // note.data
    }
  }

  async addNote(e) {
    e.preventDefault();

    const form = e.target;
    let payload = {};

    const formData = new FormData(form);

    for (const [key, value] of formData.entries()) {
      payload[key] = value;
    }

    if (payload.title) {
      try {
        let response = await axios({
          method: "POST",
          data: payload,
          url: `${this.endPoint}`,
          headers: {
            "X-WP-Nonce": globalData.nonce,
          },
        });
        let { data } = response;

        if (!data || !data.id) {
          throw new Error(data);
        }

        let markup = `
         <div style="height: auto;" class="mt-3 card note" data-id="${data.id}">
        <div class="card-header d-flex justify-content-between align-items-center">
          <input type="text" class="form-control form-control-sm w-75 border-0 bg-white note-title"
            placeholder="Note Title" value="${payload.title}" readonly />
          <div class="btn-group">
            <button class="btn btn-primary btn-sm edit-btn">Edit</button>
            <button class="btn btn-secondary btn-sm hidden cancel-btn">Cancel</button>
            <button class="btn btn-danger btn-sm  delete-btn">Delete</button>
          </div>
        </div>
        <div class="card-body">
            <textarea class="form-control   border-0 bg-white note-content" rows="5" readonly> ${payload.content} </textarea>
          <button class="mt-3 btn btn-success btn-sm hidden save-btn">Save</button>
        </div>
      </div>`;

        // this.noteContainer.insertAdjacentHTML("afterbegin", markup);

        const input = form.querySelector("input");
        const textarea = form.querySelector("textarea");

        input.value = "";
        textarea.value = "";
        window.location.reload(true);
      } catch (error) {
        let { message } = error;
        alert(message);
      }
    }
  }
}

export default Notes;
