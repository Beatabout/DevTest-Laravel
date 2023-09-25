<!DOCTYPE html>
<html>
<head>
  <title>Виділення синтаксису</title>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="/">Home</a></li>
      </ul>
    </nav>
  </header>
  <section class="...">
    <div class="...">
      <div class="...">
        <div class="...">
          <div class="...">
            <div class="chat-wrapper">
              <div id="chat-box">
                <p class="...">Стрімінг ЖПТ чату</p>
                <p class="...">
                  Стрімінг ЖПТ чату в ларавель з моделлю 3.5
                  (SSE).
                </p>
              </div>
              <form id="form-question" class="...">
                <input
                  required
                  type="text"
                  name="input"
                  placeholder="Type your question here!"
                  class="..."
                />
                <button type="submit" href="#" class="...">
                  Submit
                  <span aria-hidden="true"> → </span>
                </button>
              </form>
              <audio id="notificationSound">
                <source src="{{ asset('sounds/notification.wav') }}" type="audio/mpeg">
                Ваш браузер не підтримує аудіо-елемент.
              </audio>
              <div id="event-box"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <style>
    .chat-wrapper {
      max-width: 900px;
      margin: 0 auto;
    }
    #chat-box p:nth-child(2n){
      background-color: #f5f5f5;
      padding: 10px;
      border-radius: 10px;
      margin: 10px 0;
    }
  </style>
  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    let counter = 0;
    const notificationSound = document.getElementById('notificationSound');

    // Функція для програвання звуку сповіщення
    function playNotificationSound() {
      notificationSound.play();
    }
    var pusher = new Pusher('1277e0e169392bd06973', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('TestApp');
    channel.bind('test-event', function(data) {
      playNotificationSound();
      counter++;
      document.getElementById('event-box').textContent = counter + JSON.stringify(data);
      // alert(JSON.stringify(data));
    });
  </script>
  <script>
    const chatBox = document.getElementById("chat-box");
    const form = document.querySelector("form");
  
    form.addEventListener("submit", (event) => {
      event.preventDefault();
      const input = event.target.input.value;
      if (input === "") return;
      event.target.input.value = "";
      const newQuestion = document.createElement("p");
      newQuestion.innerText = input;
      chatBox.appendChild(newQuestion);

      const newAnswear = document.createElement("p");
      chatBox.appendChild(newAnswear);
  
      const queryQuestion = encodeURIComponent(input);
      const source = new EventSource("/ask?question=" + queryQuestion);
      source.addEventListener("update", function (event) {
        if (event.data === "<END_STREAMING_SSE>") {
          source.close();
          return;
        }
        newAnswear.innerText += event.data;
      });
    });
  </script>
  
</body>
</html>
  