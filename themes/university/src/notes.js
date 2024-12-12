import axios from "axios";

class Notes {
  constructor() {
    // Buttons
    this.editBtns = document.querySelectorAll(".edit-btn");
    this.deleteBtns = document.querySelectorAll(".delete-btn");
    this.cancelBtns = document.querySelectorAll(".cancel-btn");
    this.saveBtns = document.querySelectorAll(".save-btn");
  }

  events() {
    this.editBtns.forEach(
      function (e) {
        e.addEventListener("click", this.editNote.bind(this));
      }.bind(this)
    );

    this.cancelBtns.forEach(
      function (e) {
        e.addEventListener("click", this.cancelEdit.bind(this));
      }.bind(this)
    );
    this.deleteBtns.forEach(
      function (e) {
        e.addEventListener("click", this.deleteNote.bind(this));
      }.bind(this)
    );
    this.saveBtns.forEach(
      function (e) {
        e.addEventListener("click", this.saveNote.bind(this));
      }.bind(this)
    );
  }

  editNote(e) {
    const clickedElement = e.target;

    const note = clickedElement.closest(".note");

    if (note) {
      const editBtn = note.querySelector(".edit-btn");
      const cancelBtn = note.querySelector(".cancel-btn");
      const saveBtn = note.querySelector(".save-btn");
      const noteTitle = note.querySelector(".note-title");
      const noteContent = note.querySelector(".note-content");

      editBtn.classList.add("hidden");
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
      const saveBtn = note.querySelector(".save-btn");
      const noteTitle = note.querySelector(".note-title");
      const noteContent = note.querySelector(".note-content");

      editBtn.classList.remove("hidden");
      cancelBtn.classList.add("hidden");
      saveBtn.classList.add("hidden");

      noteTitle.setAttribute("readonly", true);
      noteTitle.classList.add("border-0");

      noteContent.setAttribute("readonly", true);
      noteContent.classList.add("border-0");
    }
  }

  saveNote(e) {
    const clickedElement = e.target;

    const note = clickedElement.closest(".note");

    if (note) {
      const editBtn = note.querySelector(".edit-btn");
      const cancelBtn = note.querySelector(".cancel-btn");
      const saveBtn = note.querySelector(".save-btn");
      const noteTitle = note.querySelector(".note-title");
      const noteContent = note.querySelector(".note-content");

      editBtn.classList.remove("hidden");
      cancelBtn.classList.add("hidden");
      saveBtn.classList.add("hidden");

      noteTitle.setAttribute("readonly", true);
      noteTitle.classList.add("border-0");

      noteContent.setAttribute("readonly", true);
      noteContent.classList.add("border-0");
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
          url: `${globalData.url}/wp-json/wp/v2/note/${id}`,
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
}

export default Notes;
