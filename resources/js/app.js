import "./bootstrap";

import { createApp } from "vue";

import ExampleCounter from "./components/ExampleCounter.vue";
import ExampleCounter2 from "./components/ExampleCounter2.vue";

const app = createApp({});

app.component("example-counter", ExampleCounter);
app.component("example-counter2", ExampleCounter2);

app.mount("#app");