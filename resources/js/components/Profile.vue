<template>
    <v-container
            fill-height
            fluid
            grid-list-xl>
        <v-layout
                justify-center
                wrap
        >
            <v-flex
                    xs12
                    md8
            >
                <v-card>
                    <v-toolbar color="primary">
                        <v-toolbar-title class="white--text">Perfil</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-form class="mt-4">
                        <v-container py-0>
                            <v-layout wrap>
                                <v-flex
                                        xs12
                                        md6
                                >
                                    <v-text-field
                                            class="purple-input"
                                            label="User Name"
                                    />
                                </v-flex>
                                <v-flex
                                        xs12
                                        md6
                                >
                                    <v-text-field
                                            label="Email Address"
                                            class="purple-input"/>
                                </v-flex>
                                <v-flex
                                        xs12
                                        md6
                                >
                                    <v-text-field
                                            label="Admin"
                                            class="purple-input"/>
                                </v-flex>
                                <v-flex
                                        xs12
                                        md6
                                >
                                    <v-text-field
                                            label="Roles"
                                            class="purple-input"/>
                                </v-flex>
                                <v-flex
                                        xs12
                                        md12
                                >
                                    <v-text-field
                                            label="Permissions"
                                            class="purple-input"/>
                                </v-flex>
                                <!--<v-flex-->
                                <!--xs12-->
                                <!--md4>-->
                                <!--<v-text-field-->
                                <!--label="City"-->
                                <!--class="purple-input"/>-->
                                <!--</v-flex>-->
                                <!--<v-flex-->
                                <!--xs12-->
                                <!--md4>-->
                                <!--<v-text-field-->
                                <!--label="Country"-->
                                <!--class="purple-input"/>-->
                                <!--</v-flex>-->
                                <!--<v-flex-->
                                <!--xs12-->
                                <!--md4>-->
                                <!--<v-text-field-->
                                <!--class="purple-input"-->
                                <!--label="Postal Code"-->
                                <!--type="number"/>-->
                                <!--</v-flex>-->
                                <!--<v-flex xs12>-->
                                <!--<v-textarea-->
                                <!--class="purple-input"-->
                                <!--label="About Me"-->
                                <!--value="Lorem ipsum dolor sit amet, consectetur adipiscing elit."-->
                                <!--/>-->
                                <!--</v-flex>-->
                                <v-flex
                                        xs12
                                        text-xs-right
                                >
                                    <v-btn
                                            class="mx-0 font-weight-light"
                                            color="success"
                                    >
                                        Modificar
                                    </v-btn>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-form>
                </v-card>
            </v-flex>
            <v-flex
                    xs12
                    md4
            >
                <material-card class="v-card-profile">
                    <v-avatar
                            slot="offset"
                            class="mx-auto d-block"
                            size="130"
                    >
                        <img
                                src="https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg"
                        >
                    </v-avatar>
                    <v-card-text class="text-xs-center">
                        <p>Username here</p>
                        <input type="file" name="avatar" id="avatar-file-input" ref="avatar" accept="image/*">
                        <v-btn
                                color="success"
                                round
                                class="font-weight-light"
                        >Upload Avatar</v-btn>
                        <p>TODO LIST AVATARS here</p>
                    </v-card-text>
                </material-card>
                <material-card class="v-card-profile">
                    <v-avatar
                            slot="offset"
                            class="mx-auto d-block"
                            size="130"
                    >
                        <img
                                src="/user/photo"
                        >
                    </v-avatar>
                    <v-card-text class="text-xs-center">
                        <p>Username here</p>
                        <form action="/photo" method="POST" enctype="multipart/form-data">
                            <input type="file" name="photo" id="photo-file-input" ref="avatar" accept="image/*">
                            <input type="hidden" name="_token" :value="csrf_token">
                            <input type="submit" value="Pujar">
                        </form>
                        <v-btn
                                color="success"
                                round
                                class="font-weight-light"
                        >Upload Photo</v-btn>
                    </v-card-text>
                </material-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import MaterialCard from './ui/MaterialCard'
export default {
  name: 'Profile',
  components: {
    'material-card': MaterialCard
  },
  created () {
    this.csrf_token = window.csrf_token
  }
}
</script>
