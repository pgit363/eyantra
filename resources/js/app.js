require('./bootstrap')

import { createApp } from 'vue'
import HelloWorld from './components/Welcome'
import Yrc from './components/yrc'
import Users from './components/users'

const app = createApp({})

app.component('hello-world', HelloWorld)
app.component('yrc', Yrc)
app.component('Users', Users)

app.mount('#app')