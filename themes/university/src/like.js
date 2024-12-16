import axios from "axios";
class Like {
  constructor() {
    this.endPoint = `${globalData.url}/wp-json/university/v1/like`;

    this.heart = document.getElementById("heart");
    this.likeCount = document.getElementById("like-count");

    if (this.heart) {
      this.events();
    }
  }

  events() {
    this.heart.addEventListener("click", this.dispatcher.bind(this));
  }

  dispatcher() {
    let status = this.heart.dataset.status;
    let id = this.heart.dataset.id;

    console.log("status", status);

    if (status && status == "active") {
      console.log("here");

      this.unLikeProfessor(id);

      return;
    }

    this.likeProfessor(id);
  }

  async likeProfessor(id) {
    try {
      let response = await axios({
        method: "POST",
        data: {
          id,
        },
        url: `${this.endPoint}`,
        headers: {
          "X-WP-Nonce": globalData.nonce,
        },
      });

      this.heart.classList.add("active");
      this.heart.setAttribute("data-status", "active");
      let total = Number(this.likeCount.dataset.total);
      total++;

      this.likeCount.setAttribute("data-total", `${total}`);
      this.likeCount.innerHTML = `${total}`;
    } catch (error) {
      let { message } = error;
      alert(message);
    }
  }

  async unLikeProfessor(id) {
    try {
      let response = await axios({
        method: "DELETE",
        data: {
          id,
        },
        url: `${this.endPoint}`,
        headers: {
          "X-WP-Nonce": globalData.nonce,
        },
      });

      this.heart.classList.remove("active");
      this.heart.setAttribute("data-status", "");
      let total = Number(this.likeCount.dataset.total);
      total--;
      this.likeCount.setAttribute("data-total", `${total}`);
      this.likeCount.innerHTML = `${total}`;
    } catch (error) {
      let { message } = error;
      alert(message);
    }
  }
}

export default Like;
