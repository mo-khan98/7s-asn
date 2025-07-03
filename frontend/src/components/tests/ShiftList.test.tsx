import { render, screen } from '@testing-library/react';
import { ShiftList } from '../ShiftList';

jest.mock('../../services/shiftService', () => ({
  shiftService: {
    getAllShifts: jest.fn().mockResolvedValue([]),
    getAllAssignments: jest.fn().mockResolvedValue([]),
  },
}));

test('renders ShiftList', async () => {
  render(<ShiftList />);
  expect(await screen.findByText(/Shifts/i)).toBeInTheDocument();
}); 