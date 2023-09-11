import "./bootstrap";

import { createApp } from "vue";

import ExampleCounter from "./components/ExampleCounter.vue";

const app = createApp({});

app.component("example-counter", ExampleCounter);

app.mount("#app");