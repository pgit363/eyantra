require('./bootstrap')

import { createApp } from 'vue'
import HelloWorld from './components/Welcome'
import Yrc from './components/yrc'

const app = createApp({})

app.component('hello-world', HelloWorld)
app.component('yrc', Yrc)

app.mount('#app')