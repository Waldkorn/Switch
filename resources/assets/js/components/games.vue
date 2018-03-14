<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://seeklogo.com/images/D/dota-2-logo-556BDCC022-seeklogo.com.png" alt="hardcoded example">
                <div class="card-body">
                  <h5 class="card-title">currently streaming: [some number]</h5>
                  <a href="#" class="btn btn-primary">Show list of streamers</a>
                </div>
              </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('games list loaded.')
        }
    }
</script>
