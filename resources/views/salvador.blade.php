<!DOCTYPE html>
<html>
<head>
  <title>Виділення синтаксису</title>
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="/">Home</a></li>
      </ul>
    </nav>
  </header>
  <section>
    <div class="chat-wrapper">
        <div id="chat-box">
        <p>Далі</p>
        <p>
            Створення картинки за описом
        </p>
        @if (@isset($imageUrl))
            <p>{{ $description }}</p>
            <img src="{{ $imageUrl }}" alt="image" />
        @endif

        </div>
        <form id="form-question" class="..." action="{{ route('salvador') }}" method="POST">
            @csrf
        <input
            required
            type="text"
            name="description"
            placeholder="Describe your image here..."
            class="..."
        />
        <button type="submit" href="#" class="...">
            Submit
        </button>
        </form>
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
</body>
</html>
  