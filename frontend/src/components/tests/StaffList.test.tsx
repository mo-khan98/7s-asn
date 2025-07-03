import { render, screen } from '@testing-library/react';
import { StaffList } from '../StaffList';

jest.mock('../../services/staffService', () => ({
  staffService: {
    getAllStaff: jest.fn().mockResolvedValue([
      { id: 1, name: 'Test', role: 'server', phone: '123', email: 'testemail@email.com', created_at: '', updated_at: '' },
    ]),
  },
}));

describe('StaffList', () => {
  it('renders with staff data', async () => {
    render(<StaffList />);
    expect(await screen.findByText(/Staff Members/i)).toBeInTheDocument();
    expect((await screen.findAllByText(/Test/i)).length).toBeGreaterThan(0);
    expect(await screen.findByText(/server/i)).toBeInTheDocument();
    expect(await screen.findByText(/123/i)).toBeInTheDocument();
    expect(await screen.findByText(/testemail@email.com/i)).toBeInTheDocument();
  });
}); 