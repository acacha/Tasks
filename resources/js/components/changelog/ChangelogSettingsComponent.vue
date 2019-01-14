<template>
    <span>
        <v-toolbar dark color="primary">
            <v-btn icon dark @click.native="$emit('close')">
                <v-icon>close</v-icon>
            </v-btn>
            <v-toolbar-title> Configuració del mòdul de registre de canvis</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items>
                <v-btn dark flat @click.native="$emit('close')" class="hidden-sm-and-down">
                    Sortir
                    <v-icon right dark>exit_to_app</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-card>
            TODO
        </v-card>
    </span>
</template>
