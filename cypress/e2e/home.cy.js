describe('Home Tests', () => {
  it('Welcome test', () => {
    cy.visit('http://127.0.0.1:8000/');
    cy.get('a').contains('About').click();
    cy.url().should('include', '/about');
    cy.get('h2').should('contain', 'About us');
  });
});