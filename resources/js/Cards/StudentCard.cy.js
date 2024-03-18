import StudentCard from './StudentCard.vue'

describe('<StudentCard />', () => {
  it('renders', () => {
    // see: https://on.cypress.io/mounting-vue
    cy.mount(StudentCard)
  })
})