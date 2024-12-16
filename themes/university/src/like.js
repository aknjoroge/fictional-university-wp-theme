import axios from "axios";
class Like {
  constructor() {
    this.endPoint = `${globalData.url}/wp-json/wp/v2/note`;

    this.heart = document.getElementById("heart");
    this.likeCount = document.getElementById("like-count");
  }

  events() {
    this.heart.addEventListener("click", this.dispatcher.bind(this));
  }

  dispatcher() {
    let status = this.heart.dataset.status;
    let id = this.heart.dataset.id;

    if (status && status == "active") {
      this.likeProfessor(id);
      return;
    }

    this.unLikeProfessor(id);
  }

  likeProfessor(id) {}

  unLikeProfessor(id) {}
}
