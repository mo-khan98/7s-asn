import { render, screen } from '@testing-library/react';
import { StaffList } from '../StaffList';

jest.mock('../../services/staffService', () => ({
  staffService: {
    getAllStaff: jest.fn().mockResolvedValue([]),
  },
}));

test('renders StaffList', async () => {
  render(<StaffList />);
  expect(await screen.findByText(/Staff Members/i)).toBeInTheDocument();
}); 