import { render, screen, fireEvent } from '@testing-library/react';
import { AddStaffForm } from '../AddStaffForm';

jest.mock('../../services/staffService', () => ({
  staffService: {
    createStaff: jest.fn().mockResolvedValue({ id: 1 }),
  },
}));

describe('AddStaffForm', () => {
  it('renders all form fields and button', () => {
    render(<AddStaffForm onStaffAdded={() => {}} />);
    expect(screen.getByLabelText(/Name/i)).toBeInTheDocument();
    expect(screen.getByText(/Role/i)).toBeInTheDocument();
    expect(screen.getByLabelText(/Phone/i)).toBeInTheDocument();
    expect(screen.getByLabelText(/Email/i)).toBeInTheDocument();
    expect(screen.getByRole('button', { name: /Add Staff Member/i })).toBeInTheDocument();
  });

  it('updates input values when typing', () => {
    render(<AddStaffForm onStaffAdded={() => {}} />);
    const nameInput = screen.getByLabelText(/Name/i);
    fireEvent.change(nameInput, { target: { value: 'Test' } });
    expect(nameInput).toHaveValue('Test');
  });

  it('calls onStaffAdded after submit', async () => {
    const mockOnStaffAdded = jest.fn();
    render(<AddStaffForm onStaffAdded={mockOnStaffAdded} />);
    fireEvent.change(screen.getByLabelText(/Name/i), { target: { value: 'Test' } });
    fireEvent.change(screen.getByLabelText(/Phone/i), { target: { value: '123' } });
    fireEvent.change(screen.getByLabelText(/Email/i), { target: { value: 'test@email.com' } });

    // selecting the role
    fireEvent.mouseDown(screen.getByText(/Role/i).parentElement!.querySelector('[data-slot="select-trigger"]')!);
    const options = screen.getAllByText('Server');
    fireEvent.click(options[options.length - 1]);
    fireEvent.click(screen.getByRole('button', { name: /Add Staff Member/i }));
    await screen.findByRole('button', { name: /Add Staff Member/i });
    expect(mockOnStaffAdded).toHaveBeenCalled();
  });
}); 