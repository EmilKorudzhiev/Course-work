<div class="row w-100 justify-content-center m-auto">
    <div class="AIchat col-12 col-md-10 col-lg-8 col-xl-6 pb-3 mt-5">
        <header class="navbar">
            <a href="https://openai.com/blog/chatgpt" style="display:inline-flex;" class="nav-link align-items-center">
                <span class="d-none d-sm-block" style="margin-right:5px;">Powered by</span> 
                <svg viewBox="0 0 320 320" style="height:30;">
                    <g fill="currentColor">
                        <path d="m297.06 130.97c7.26-21.79 4.76-45.66-6.85-65.48-17.46-30.4-52.56-46.04-86.84-38.68-15.25-17.18-37.16-26.95-60.13-26.81-35.04-.08-66.13 22.48-76.91 55.82-22.51 4.61-41.94 18.7-53.31 38.67-17.59 30.32-13.58 68.54 9.92 94.54-7.26 21.79-4.76 45.66 6.85 65.48 17.46 30.4 52.56 46.04 86.84 38.68 15.24 17.18 37.16 26.95 60.13 26.8 35.06.09 66.16-22.49 76.94-55.86 22.51-4.61 41.94-18.7 53.31-38.67 17.57-30.32 13.55-68.51-9.94-94.51zm-120.28 168.11c-14.03.02-27.62-4.89-38.39-13.88.49-.26 1.34-.73 1.89-1.07l63.72-36.8c3.26-1.85 5.26-5.32 5.24-9.07v-89.83l26.93 15.55c.29.14.48.42.52.74v74.39c-.04 33.08-26.83 59.9-59.91 59.97zm-128.84-55.03c-7.03-12.14-9.56-26.37-7.15-40.18.47.28 1.3.79 1.89 1.13l63.72 36.8c3.23 1.89 7.23 1.89 10.47 0l77.79-44.92v31.1c.02.32-.13.63-.38.83l-64.41 37.19c-28.69 16.52-65.33 6.7-81.92-21.95zm-16.77-139.09c7-12.16 18.05-21.46 31.21-26.29 0 .55-.03 1.52-.03 2.2v73.61c-.02 3.74 1.98 7.21 5.23 9.06l77.79 44.91-26.93 15.55c-.27.18-.61.21-.91.08l-64.42-37.22c-28.63-16.58-38.45-53.21-21.95-81.89zm221.26 51.49-77.79-44.92 26.93-15.54c.27-.18.61-.21.91-.08l64.42 37.19c28.68 16.57 38.51 53.26 21.94 81.94-7.01 12.14-18.05 21.44-31.2 26.28v-75.81c.03-3.74-1.96-7.2-5.2-9.06zm26.8-40.34c-.47-.29-1.3-.79-1.89-1.13l-63.72-36.8c-3.23-1.89-7.23-1.89-10.47 0l-77.79 44.92v-31.1c-.02-.32.13-.63.38-.83l64.41-37.16c28.69-16.55 65.37-6.7 81.91 22 6.99 12.12 9.52 26.31 7.15 40.1zm-168.51 55.43-26.94-15.55c-.29-.14-.48-.42-.52-.74v-74.39c.02-33.12 26.89-59.96 60.01-59.94 14.01 0 27.57 4.92 38.34 13.88-.49.26-1.33.73-1.89 1.07l-63.72 36.8c-3.26 1.85-5.26 5.31-5.24 9.06l-.04 89.79zm14.63-31.54 34.65-20.01 34.65 20v40.01l-34.65 20-34.65-20z">
                        </path>
                    </g>
                </svg>
            </a>
                
            <h3 class="m-0">
                Съобщения 
                <span
                id="info"
                class="bi bi-info-circle h4"

                data-bs-toggle="popover"
                data-bs-trigger="hover"
                data-bs-placement="bottom"
                data-bs-title="Какво е това?"
                data-bs-content="
                Това е чат с изкуствен интелект. Той може да отговори на много въпроси свързани с риболова. Може да върне грешна информация!"
                ></span>
            </h3>

            <button class="btn btn-outline-dark p-1" onclick="location.href='/Course-work/components/ai_chat_clear_history.php'" >
                <span class="d-none d-sm-block">Изтрии история</span>
                <i class="bi bi-trash h-2 d-sm-none h4"></i>
            </button>
        </header>

        <main class="AIchat-body" id="chatBody">
            
            <?php
            $chat_history = $_SESSION['context'] ?? [];

            foreach ($chat_history as $chat_message) {
                if($chat_message['role'] == "system"){
                    echo "";
                }else{
                    $direction = $chat_message['role'] === "user" ? "prompt" : "response";
                    echo '<div class="AIchat-msg msg-'.$direction.'">'.'<p>'.$chat_message['content'].'</p>'.'</div>';
                }
            }
            ?>
        
        </main>

        <form id="sendMessage" class="w-100">
            <div class="input-group w-100">
                <input class="form-control" type="text" id="message" placeholder="Въведете съобщение..." required>
                <div class="input-group-append">
                    <button id="submit" type="submit" class="btn btn-outline-secondary">Изпрати</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>

var popover = new bootstrap.Popover(document.getElementById('info'));

$("#sendMessage").on("submit", function(e) {
    e.preventDefault();
    
    

    $('#submit'). prop('disabled', true);

    var message = $("#message").val();

    $.ajax({
      url: "/Course-work/components/ai_chat_message_response.php",
      type: "post",
      data: {
        message: message
      },
      dataType: "json",
      success: function(response) {
        console.log(response);

        var prompt = response.prompt;
        var answer = response.answer;

        setTimeout(function() {
        $('#chatBody').append(prompt);
        $('#chatBody').append(answer);

        $("#message").val("");
        button.disabled = false;
        }, 5);
      },
      error: function(xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  });
</script>
