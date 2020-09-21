<div class="container match-container">
   <h4 class="w-100">{{ $title }}</h4>
   <div class="table-rival">
     <p>{{__("Selecciona un rival")}}</p>
     <div class="user">
       @foreach($users as $user)
        <div class="data user-select" data-id="{{$user->id}}" data-name="{{$user->name}}">
          <img src="{{"/assets/img/user.svg"}}" class="img-fluid" alt=""/>
          <span>{{$user->name}}</span>
        </div>
       @endforeach
       <div class="refresh"><img src="{{"/assets/img/refresh.png"}}" class="img-fluid" alt=""/></div>
     </div>

     <div class="game-stat">
       <h6>{{__("Resultado")}}</h6>
       <form class="d-flex flex-column justify-content-center align-items-center" method="POST" action="{{ $route }}">
         @csrf
         <div class="d-flex align-items-center justify-content-center contents-games">
           <div class="info">
             <label><img src="{{"/assets/img/user.svg"}}" class="img-fluid" alt=""/></label>
             <span class="local-name"></span>
             <input type="hidden" class="form-control bg-transparent" name="local_id"/>
           </div>
           <div class="score d-flex align-items-center">
            <input type="number" class="form-control input-scores" name="gol_local"  min="0"/>
            -
            <input type="number" class="form-control input-scores" name="gol_visit" min="0"/>
           </div>
           <div class="info">
             <label><img src="{{"/assets/img/user.svg"}}" class="img-fluid" alt=""/></label>
             <span class="visit-name"></span>
             <input type="hidden" class="form-control bg-transparent" name="visit_id"/>
           </div>
         </div>
         <input type="hidden" class="form-control bg-transparent" name="winner"/>
         <input type="hidden" class="form-control bg-transparent" name="loser"/>
         <input type="hidden" class="form-control bg-transparent" name="draw"/>
         <div class="content-penaltys display-none">
           <div class="penaltys">
             <input type="checkbox" name="check_penalty" />
             <label>{{ __("Existio Penales?") }}</label>
           </div>
           <select class="form-control display-none" id="winner-penalty" name="winnerpenaltys">
              <option value="">{{__("Selecciona el ganador")}}</option>
             @foreach($users as $user)
              <option value="{{$user->id}}">{{$user->name}}</option>
             @endforeach
           </select>
         </div>
         <button class="btn-styles back-green disabled-button" id="submit-button">
          {{ $textButton }}
        </button>
       </form>
     </div>
   </div>
</div>

<script>
let local_id;
let visit_id;


const select_users = document.querySelectorAll(".user-select");
const refresh = document.querySelector(".refresh");

const local_name = document.querySelector(".local-name");
const visit_name = document.querySelector(".visit-name");

const input_local_id = document.querySelector("input[name='local_id']");
const input_visit_id = document.querySelector("input[name='visit_id']");

const inputs_score = document.querySelectorAll(".input-scores");
const input_local_score = document.querySelector("input[name='gol_local']");
const input_visit_score = document.querySelector("input[name='gol_visit']");

const winner_input = document.querySelector("input[name='winner']");
const draw_input = document.querySelector("input[name='draw']");
const loser_input = document.querySelector("input[name='loser']");

const container_penalties = document.querySelector(".content-penaltys");
const check_penalty = document.querySelector("input[name='check_penalty']");
const select_winner_penalty = document.querySelector("#winner-penalty");

const btn_save = document.getElementById("submit-button");

select_users.forEach(user => {
  user.addEventListener('click', (e) => {
    e.target.classList.add("selected-user");
    if(!local_id){
      local_id = e.target.dataset.id;
      refresh.style.display = "block";
      local_name.innerHTML = e.target.dataset.name;
      input_local_id.value = e.target.dataset.id;
    }else{
        visit_id = e.target.dataset.id;
        visit_name.innerHTML = e.target.dataset.name;
        input_visit_id.value = e.target.dataset.id;
        select_users.forEach(user=> {
          user.classList.add("disabled_user");
          (user.dataset.id === local_id || user.dataset.id === visit_id) ? user.classList.add("selected-user") : user.classList.add("opacity_user");
        });
    }
    checkbutton();
  });
});

refresh.addEventListener("click", ()=>{
  local_id = null;
  visit_id = null;
  local_name.innerHTML = '';
  visit_name.innerHTML = '';
  input_local_score.value = 0;
  input_visit_score.value = 0;
  btn_save.classList.add("disabled-button");
  draw_input.value = 0;
  container_penalties.classList.add("display-none");
  select_winner_penalty.value = '';
  select_winner_penalty.classList.add("display-none");
  select_users.forEach(user => {
    user.classList.remove("selected-user");
    user.classList.remove("disabled_user");
    user.classList.remove("opacity_user");
  });
});

inputs_score.forEach(score => {
  score.addEventListener('keyup', (e) => {
    if(e.target.value < 0){
      e.target.value = 0;
    }
    if(input_local_score.value === input_visit_score.value){
      container_penalties.classList.remove("display-none");
      draw_input.value = 1;
      winner_input.value = null;
      loser_input.value = null;
    }else{
      container_penalties.classList.add("display-none");
      draw_input.value = 0;
      if(input_local_score.value > input_visit_score.value){
        winner_input.value = local_id;
        loser_input.value = visit_id;
      }else{
        winner_input.value = visit_id;
        loser_input.value = local_id;
      }
    }

    checkbutton();
  });
});

check_penalty.addEventListener("change", (e)=>{
  if(e.target.checked){
    select_winner_penalty.classList.remove("display-none");
  }else{
    select_winner_penalty.value = '';
    select_winner_penalty.classList.add("display-none");
  }
  checkbutton();
});

select_winner_penalty.addEventListener("change", ()=>{
  checkbutton();
});

function checkbutton(){
  if(local_id && visit_id && input_local_score.value !== '' && input_visit_score.value !== ''){
    btn_save.classList.remove("disabled-button");
  }else{
    btn_save.classList.add("disabled-button");
  }
  if(check_penalty.checked){
    if(select_winner_penalty.value != ''){
      btn_save.classList.remove("disabled-button");
    }else{
      btn_save.classList.add("disabled-button");
    }
  }
}
checkbutton();

</script>
