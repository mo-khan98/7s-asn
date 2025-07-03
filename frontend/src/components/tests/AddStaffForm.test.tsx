import { render, screen } from '@testing-library/react';
import { AddStaffForm } from '../AddStaffForm';
 
test('renders AddStaffForm', () => {
  render(<AddStaffForm onStaffAdded={() => {}} />);
  expect(screen.getByText(/Add New Staff Member/i)).toBeInTheDocument();
}); 