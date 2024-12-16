import "../css/style.scss";

import "./maps";
import Search from "./search";
import Notes from "./notes";
import Like from "./like";

new Search().events();

new Notes();

new Like();
