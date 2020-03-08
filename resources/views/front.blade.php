@extends('layouts.app')

@section('content')

    <div class ="container">
        <section>
        <div>
            <b-jumbotron header="BootstrapVue" lead="Bootstrap v4 Components for Vue.js 2">
                <p>For more information visit website</p>
                <b-button variant="primary" href="#">More Info</b-button>
            </b-jumbotron>
        </div>
        <section>

        <section>
            <div>
                <b-card-group deck>
                  <b-card title="Title" img-src="https://picsum.photos/300/300/?image=41" img-alt="Image" img-top>
                    <b-card-text>
                      This is a wider card with supporting text below as a natural lead-in to additional content.
                      This content is a little bit longer.
                    </b-card-text>
                    <template v-slot:footer>
                      <small class="text-muted">Last updated 3 mins ago</small>
                    </template>
                  </b-card>
              
                  <b-card title="Title" img-src="https://picsum.photos/300/300/?image=41" img-alt="Image" img-top>
                    <b-card-text>
                      This card has supporting text below as a natural lead-in to additional content.
                    </b-card-text>
                    <template v-slot:footer>
                      <small class="text-muted">Last updated 3 mins ago</small>
                    </template>
                  </b-card>
              
                  <b-card title="Title" img-src="https://picsum.photos/300/300/?image=41" img-alt="Image" img-top>
                    <b-card-text>
                      This is a wider card with supporting text below as a natural lead-in to additional content.
                      This card has even longer content than the first to show that equal height action.
                    </b-card-text>
                    <template v-slot:footer>
                      <small class="text-muted">Last updated 3 mins ago</small>
                    </template>
                  </b-card>
                </b-card-group>
            </div>
        </section>

        <section>
            <pricing></pricing>
        </section>

    </div>

@endsection